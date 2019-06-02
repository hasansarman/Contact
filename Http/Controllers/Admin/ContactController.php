<?php

namespace Modules\Contact\Http\Controllers\Admin;

use App\DataTables\ContactDataTable;
use App\DataTables\ContactSubjectDataTable;
use App\Models\ContactSubject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\HsContact;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Auth;
class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;

    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->contact = $contact;
        /*$this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });*/

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ContactDataTable $dataTable)
    {
        //$contacts = $this->contact->all();
        $contact_subjects=ContactSubject::all();
        $tempo_array=array();
        foreach($contact_subjects as $c){
            $tempocount=HsContact::where(["CONTACT_SUBJECT_ID"=>$c->CONTACT_SUBJECT_ID])->count();
            $data=array();
            $data["NUMBER"]=$tempocount;
            $data["ID"]=$c->CONTACT_SUBJECT_ID;
            $data["SUBJECT"]=$c->SUBJECT;
            $tempo_array[]=$data;
        }

        return $dataTable->render('contact::admin.contacts.index',["filtered_value"=>$tempo_array]);
       // return view('contact::admin.contacts.index', compact(''));
    }

    public function details(HsContact $contacts)
    {
    $contacts->IS_READ=1;
    $contacts->save();
        $foo=HsContact::where("PARENT_ID",'=',$contacts->CONTACT_ID)->orderBy('IDATE')->get();

        return view('contact::admin.contacts.detail', ["contact"=>$contacts,"othermessages"=>$foo]);
    }
    public function send_me(Request $request)
    {

        //print_r($request->all());
        $user=request()->user();
        //echo $user->first_name.' '.$user->last_name;
        //echo $user->email.' '.$user->id;
        //print_r( request()->user()->NAME);
        //return;
        $parent_id=$request->input('parent_id');
        $contact_id=$request->input('contact_id');
        $text=$request->input('text');
        $contact_subject_id=$request->input('contact_subject_id');

        $foo=new HsContact();
        $foo->PARENT_ID=$parent_id;
        $foo->MESSAGE=$text;
        $foo->NAME=$user->first_name;
        $foo->SURNAME=$user->last_name;
        $foo->EMAIl=$user->email;
        $foo->CONTACT_SUBJECT_ID=$contact_subject_id;
        $foo->save();
       // print_r($foo);
        return;
      /*  "parent_id": parent_id,
                    "contact_id" : contact_id,
                "text" :text0*/
    }
    public function end_me(Request $request)
    {
        $parent_id=$request->input('parent_id');
        $contact_id=$request->input('contact_id');
        $text=$request->input('text');
        $contact_subject_id=$request->input('contact_subject_id');

        $foo=HsContact::where("PARENT_ID",$contact_id)->get();
        foreach($foo as $f){
            $f->IS_ACTIVE=0;
            $f->save();
        }
        $foo1=HsContact::where("CONTACT_ID",$contact_id)->get();
        foreach($foo1 as $f){
            $f->IS_ACTIVE=0;
            $f->save();
        }

    }
    public function contact_categories(ContactSubjectDataTable $dataTable){
        return $dataTable->render('contact::admin.contact_categories.index',[]);
       // return view('contact::admin.contact_categories.index', compact(''));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function contact_categories_create()
    {
        return view('contact::admin.contact_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function contact_categories_store(Request $request)
    {
        $fooarray=$request->except('_token');

        $temp= ContactSubject::firstOrNew($fooarray);
        $temp->save();

        return redirect()->route('admin.contact.contact_categories')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function contact_categories_edit(ContactSubject $contact_categories)
    {
        return view('contact::admin.contact_categories.edit', compact('contact_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Contact $contact
     * @param  Request $request
     * @return Response
     */
    public function contact_categories_update(ContactSubject $contact_categories, Request $request)
    {
        $fooarray=$request->except('_token');
        $contact_categories->update($fooarray);
        $contact_categories->save();

        return redirect()->route('admin.contact.contact_categories')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function contact_categories_destroy(ContactSubject $contact_categories)
    {
        $contact_categories->delete();

        return redirect()->route('admin.contact.contact_categories')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('contact::contacts.title.contacts')]));
    }







}
