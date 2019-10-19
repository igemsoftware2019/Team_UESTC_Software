<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function xmldownload(){
        if (Storage::disk('s3')->exists("bio/BioMaster_xml.zip")){
            return Storage::disk('s3')->download('bio/BioMaster_xml.zip');
            }
        else{
                $url = $request->session()->get('_previous.url');
                return redirect($url);
        }

    }

    public function csvdownload(){
        if (Storage::disk('s3')->exists("bio/BioMaster_csv.zip")){
            return Storage::disk('s3')->download('bio/BioMaster_csv.zip');
            }
        else{
                $url = $request->session()->get('_previous.url');
                return redirect($url);
        }

    }

    public function sqldownload(){
        if (Storage::disk('s3')->exists("bio/BioMaster_sql.zip")){
            return Storage::disk('s3')->download('bio/BioMaster_sql.zip');
            }
        else{
                $url = $request->session()->get('_previous.url');
                return redirect($url);
        }

    }

    public function detaildownload(Request $request){
        $igemid = $request->route('igemid');
        $type=$request->route('type');
        // dd($type);
        if($type=='xml'){
            if (Storage::disk('s3')->exists("bio/xml/$igemid.xml")){
                return Storage::disk('s3')->download("bio/xml/$igemid.xml");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }

        if($type=='fasta'){
            if (Storage::disk('s3')->exists("bio/fasta/$igemid.fasta")){
                return Storage::disk('s3')->download("bio/fasta/$igemid.fasta");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }

        if($type=='unisequence'){
            if (Storage::disk('s3')->exists("bio/uniseq/$igemid.fasta")){
                return Storage::disk('s3')->download("bio/uniseq/$igemid.fasta");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }

        if($type=='feature'){
            if (Storage::disk('s3')->exists("bio/feature/$igemid.csv")){
                return Storage::disk('s3')->download("bio/feature/$igemid.csv");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }

        if($type=='aasequence'){
            if (Storage::disk('s3')->exists("bio/aa/$igemid.fasta")){
                return Storage::disk('s3')->download("bio/aa/$igemid.fasta");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }

        if($type=='ntsequence'){
            if (Storage::disk('s3')->exists("bio/nt/$igemid.fasta")){
                return Storage::disk('s3')->download("bio/nt/$igemid.fasta");
                }
            else{
                    $url = $request->session()->get('_previous.url');
                    return redirect($url);
            }
        }



    }
}
