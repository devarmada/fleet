<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
  protected $guarded = [];

  public function aircraft() {
      return $this->belongsTo('App\Aircraft');
  }

  public function user() {
      return $this->belongsTo('App\User');
  }

  // icon collection: https://github.com/pasnox/oxygen-icons-png/tree/master/oxygen/256x256/mimetypes
  public function get_icon() {
    $icon="application-octet-stream.png";
    if(preg_match('/application\/.*word.*/', $this->file_type)){
      $icon="application-msword.png";
    } elseif(preg_match('/application\/.*pdf.*/', $this->file_type)){
      $icon="application-pdf.png";
    } elseif(preg_match('/(application|text)\/.*rtf.*/', $this->file_type)){
      $icon="application-rtf.png";
    } elseif(preg_match('/application\/.*kml.*/', $this->file_type)){
      $icon="application-vnd-google-earth-kml.png";
    } elseif(preg_match('/application\/.*excel.*/', $this->file_type)){
      $icon="application-vnd.ms-excel.png";
    } elseif(preg_match('/application\/.*powerpoint.*/', $this->file_type)){
      $icon="application-vnd.ms-powerpoint.png";
    } elseif(preg_match('/application\/.*zip.*/', $this->file_type)){
      $icon="application-zip.png";
    } elseif(preg_match('/(application|text)\/.*vcal.*/', $this->file_type)){
      $icon="text-vcalendar.png";
    } elseif(preg_match('/(application|text)\/.*csv.*/', $this->file_type)){
      $icon="text-csv.png";
    } elseif(preg_match('/(application|text)\/.*(html|xml).*/', $this->file_type)){
      $icon="application-xhtml-xml.png";
    } elseif(explode("/", $this->file_type)[0] == "audio"){
      $icon="audio-x-generic.png";
    } elseif(explode("/", $this->file_type)[0] == "text"){
      $icon="text-plain.png";
    } elseif(explode("/", $this->file_type)[0] == "video"){
      $icon="video-x-generic.png";
    }
    return $icon;
  }

}
