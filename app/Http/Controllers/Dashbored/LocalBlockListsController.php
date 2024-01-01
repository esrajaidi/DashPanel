<?php

namespace App\Http\Controllers\Dashbored;

use App\Http\Controllers\Controller;
use App\Imports\LocalBlockListsImport;
use App\Models\LocalBlockLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class LocalBlockListsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:local_block_lists', ['only' => ['local_block_lists']]);
        $this->middleware('permission:local_block_lists_uplode', ['only' => ['uplode','storeUplode']]);

        
    }
     
  
        

    public function index(Request $request)
    {
        // ActivityLogger::activity("قوائم الحظر المحلية");
        // $data = LocalBlockLists::latest()->get();
        // // $data=$data->where('statement', 'Like', '%شركة فالكون لإستيراد السيارت وقطع الغيار%')->all();
        // dd($data);
        // if(!empty($request->statement)){

        // }
        if ($request->ajax()) {
            $data = LocalBlockLists::latest()->get();
            // $request->statement="ف";
            // if(!empty($request->statement)){
            //     $data=$data->where('statement', 'like', '%'.$request->statement.'%')->get();
            //     dd($request);

            // }
           

            
            return Datatables::of($data)
                    ->addIndexColumn()
                    
                     ->addColumn('statu', function ($data) {
                
                
                if($data->statu==0)
                return '<span class="label label-success">رفع تجميد</span>';
                else
                return  '<span class="label label-danger"> تم تجميده</span>';
            })
            ->rawColumns(['statu'])
                    ->make(true);
        }
    
        return view('dashboard.local_block_lists.index');
    }


    


   
    
    public function uplode(){

        ActivityLogger::activity("عرض صفحة تحميل قوائم الحظر المحلي");


        return view('dashboard.local_block_lists.uplode');

    }


    
    /**
     * Show the form for creating a new resource.
     */
    

    public function storeUplode(Request $request)
    {
        

        $messages = [
            'file_local_block_lists.required' => 'الرجاء تحميل ملف ',
            
        ];
        $this->validate($request, [
            'file_local_block_lists' => ['required'],
        ], $messages);


        try {

            $file = $request->file('file_local_block_lists');
            $fileName = $file->getClientOriginalName();
            $existsRecord=LocalBlockLists::where('file_name',"=",$fileName)->count();
            if($existsRecord != 0){
                Alert::warning("لقد سبق وتم تحميل هذا الملف مسبقا (". $fileName.")");
                return redirect()->back();
             }
           

            DB::transaction(function () use ($request,$fileName) {
    
                Excel::import(new LocalBlockListsImport($fileName),
                      $request->file('file_local_block_lists')->store('files'));
                      
            });
            ActivityLogger::activity('تمت عملية  تحميل ملف قوائم الحظر المحلية بنجاح');

            Alert::success('تمت عملية  تحميل ملف قوائم الحظر المحلية بنجاح');

            return redirect('local_block_lists');
        } catch (\Exception $e) {
            Alert::warning($e->getMessage());
            ActivityLogger::activity( " فشل تحميل ملف قوائم الحظر المحلية");

            return redirect()->back();
        }
       
    }

    public function create()
    {
        ActivityLogger::activity("عرض صفحة إضافه شركة لقوائم الحظر المحلية");
        return view('dashboard.local_block_lists.create');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [

            'statement' => ['required'],
            'hiddenBy' => ['required'],
            'dateofreceivedMessage' => ['required'],
            'index' => ['required'],


        ]);
        try {
            DB::transaction(function () use ($request) {
                $local_block = DB::table('local_block_lists')
                ->latest()
                ->first();
                dd($local_block);

                $localBlockLists = new LocalBlockLists();
                $localBlockLists->rt=($local_block==null) ? 0 : $local_block->rt + 1;
                $localBlockLists->statement=$request->statement;
                $localBlockLists->hiddenBy=$request->hiddenBy;
                $localBlockLists->dateofreceivedMessage=$request->dateofreceivedMessage;
                $localBlockLists->index=$request->index;
                $localBlockLists->notes=$request->notes;
                $localBlockLists->statu=($localBlockLists->notes== null) ? 1 : 0;

                 ActivityLogger::activity($localBlockLists->statement. ":إضافه شركة لقوائم الحظر المحلية ");
                $localBlockLists->save();
            });

            Alert::success('تمت عملية إرسال رسالة بنجاح');
            return redirect()->route('local_block_lists');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($e->getMessage() .": فشل إضافه شركة لقوائم الحظر المحلية ");

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalBlockLists $localBlockLists)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocalBlockLists $localBlockLists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocalBlockLists $localBlockLists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalBlockLists $localBlockLists)
    {
        //
    }
}
