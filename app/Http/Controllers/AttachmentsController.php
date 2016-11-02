<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Attachment;
use App\Aircraft;
use App\FleetList;
use Redirect;
use Session;


class AttachmentsController extends Controller
{
  protected $rules = [
    'title' => ['required'],
    'aircraft_id' => ['required'],
    'user_id' => ['required'],
    'file_name' => ['max:10240', 'mimes:gpx,doc,dot,pdf,rtf,gmx,kml,kmz,xkml,xls,xlm,xla,xlc,xlt,xlw,mpp,mpt,odc,otc,odb,odf,odg,odi,oti,odp.ods,odt,odm,oth,pptx,sldx,ppsx,xslx,docx,rm,rmvb,sdc,sda,sdd,smf,sdw,vor,sgl,sxc,sxd,sxi,sxm,sxw,sxg,vsd,wpd,7z,abw,bz,bz2,boz,vst,vss,vsw,gnumeric,wri,rar,swf,tar,xhtml,xht,xml,xsl,dtd,xslt,zip,adp,au,snd,m4a,mp4a,mpga,mp2,mp2a,mp3,m2a,m3a,oga,ogg,spx,aac,flac,mka,m3u,wma,ram,ra,rmp,wav,bmp,gif,jpeg,jpg,jpe,png,btif,sgi,svg,svgz,tiff,tif,psd,xbm,xpm,csv,html,htm,txt,text,conf,def,list,log,in,rtx,sgml,sgm,vcard,vcs,vcf,3gp,3g2,jpgv,jpm,jpgm,mp4,mp4v,mpg4,mpeg,mpg,mpe,m1v,m2v,ogv,qt,mov,mxu,m4u,webm,f4v,fli,flv,m4v,mkv,mk3d,mks,asf,asx,wm,wmx,wvx,avi'],
  ];
  // for mime types see https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types

  protected $create_rules = [
    'file_name' => ['required'],
  ];

  public function __construct() {
    $this->middleware('auth');
  }

  public function index(FleetList $fleet_list, Aircraft $aircraft){
    $user = Auth::user();
    if(!$fleet_list->is_accessible_by($user)){
      return view('common.not_authorized');
    }
    Session::put('backUrl', route('fleet_lists.aircrafts.attachments.index', [$fleet_list, $aircraft]));
    return view('aircrafts.show', compact('fleet_list','aircraft', 'user'));
  }

  public function create(FleetList $fleet_list, Aircraft $aircraft) {
    $user = Auth::user();
    if(!$fleet_list->is_accessible_by($user)){
      return view('common.not_authorized');
    }
    return view('attachments.create', compact('user', 'fleet_list', 'aircraft'));
  }

  public function store(FleetList $fleet_list, Aircraft $aircraft, Request $request) {
    $user = Auth::user();
    if(!$fleet_list->is_accessible_by($user)){
      return redirect(Session::get('backUrl'))->withErrors('Create error: not authorized');
    }

    $this->validate($request, $this->rules);
    $this->validate($request, $this->create_rules);

    $input = Input::all();
    if(!$request->hasFile('file_name')){
      return redirect(Session::get('backUrl'))->withErrors('Create error: file not specified');
    }

    $input = array_merge($input, $this->store_file($request->file('file_name')));

    Attachment::create($input);
    return Redirect::route('fleet_lists.aircrafts.show', [$fleet_list, $aircraft, $user])->with('message', 'Attachment created.');
  }

  public function show(FleetList $fleet_list, Aircraft $aircraft, Attachment $attachment) {
    $user = Auth::user();
    if($aircraft != $attachment->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user)){
      return view('common.not_authorized');
    }
    Session::put('backUrl', route('fleet_lists.aircrafts.attachments.show', array($fleet_list, $aircraft, $attachment, $user)));
    return view('attachments.show', compact('fleet_list', 'aircraft', 'attachment', 'user'));
  }

  public function get_attachment(FleetList $fleet_list, Aircraft $aircraft, Attachment $attachment) {
    $user = Auth::user();
    if($aircraft != $attachment->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user)){
      return view('common.not_authorized');
    }

    $file = Storage::disk('local')->get($attachment->file_path);

    return (new Response($file, 200))->header('Content-Type', $attachment->file_type)->header('Content-Disposition', 'inline; filename="' . $attachment->file_name . '"');
  }

  public function edit(FleetList $fleet_list, Aircraft $aircraft, Attachment $attachment) {
     $user = Auth::user();
     if($aircraft != $attachment->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user) || $attachment->user != $user){
       return view('common.not_authorized');
     }
     return view('attachments.edit', compact('user', 'fleet_list', 'aircraft', 'attachment'));
  }

  public function update(Request $request, FleetList $fleet_list, Aircraft $aircraft, Attachment $attachment) {
     $user = Auth::user();
     if($aircraft != $attachment->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user) || $attachment->user != $user){
       return redirect(Session::get('backUrl'))->withErrors('Update error: not authorized');
     }
     $this->validate($request, $this->rules);
     $input = array_except(Input::all(), '_method');

     if($request->hasFile('file_name')){
       $input = array_merge($input, $this->store_file($request->file('file_name')));
     }

     $attachment->update($input);
     return redirect(Session::get('backUrl'))->with('message', 'Attachment updated');
  }

  public function destroy(FleetList $fleet_list, Aircraft $aircraft, Attachment $attachment) {
     $user = Auth::user();
     if($aircraft != $attachment->aircraft || $fleet_list != $aircraft->fleet_list || !$fleet_list->is_accessible_by($user) || $attachment->user != $user){
       return redirect (Session::get('backUrl'))->withErrors('Delete error: not authorized');
     }

     $attachment->delete();
     Storage::disk('local')->delete($attachment->file_path);

     return Redirect::route('fleet_lists.aircrafts.show', [$fleet_list->id, $aircraft->id, $user])->with('message', 'Attachment deleted.');
  }

  private function store_file($file){
    $extension = $file->getClientOriginalExtension();
    Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
    return ['file_type' => $file->getClientMimeType(),
            'file_name' => $file->getClientOriginalName(),
            'file_path'=> $file->getFilename().'.'.$extension];
  }
}
