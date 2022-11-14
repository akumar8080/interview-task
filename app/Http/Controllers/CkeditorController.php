<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use DB;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
  
class CkeditorController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allContents = DB::table('table_content')->where('user_id', Auth()->id())->get();
        return view('ckeditor', compact('allContents'));
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
            $content_id = DB::table('table_content')->insertGetId(['user_id'=> Auth()->id(), 'image' => Session::get('image_url')]);
            Session::put('content_id', $content_id);
        }
    }


    public function contentUpload(Request $request)
    {
        $content_id = Session::get('content_id');
        $content_id = DB::table('table_content')->where('id', $content_id)->update(['content' => $request->editor1]);
        return redirect('ckeditor');
    }

}