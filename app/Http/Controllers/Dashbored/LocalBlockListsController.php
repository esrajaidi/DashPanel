<?php

namespace App\Http\Controllers\Dashbored;

use App\Exports\LocalBlockListsExport;
use App\Http\Controllers\Controller;
use App\Imports\LocalBlockListsImport;
use App\Models\LocalBlockLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $this->middleware('permission:local_block_lists-uplode', ['only' => ['uplode','storeUplode']]);
        $this->middleware('permission:local_block_lists-create', ['only' => ['create','store']]);
        $this->middleware('permission:local_block_lists-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:local_block_lists-export', ['only' => ['export']]);

        
    }
     
  
    public function index(Request $request)
    {
    if ($request->ajax()) {
    $data = LocalBlockLists::latest()->get();
    return Datatables::of($data)
    ->addIndexColumn()
    ->filter(function ($instance) use ($request) {
    if (!empty($request->statement)) {
    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    return Str::contains($row['statement'], $request->get('statement')) ? true : false;
    });
    }
    if (!empty($request->index)) {
        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
        return Str::contains($row['index'], $request->get('index')) ? true : false;
        });
    }
    if (!empty($request->dateofreceivedMessage)) {
        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
        return Str::contains($row['dateofreceivedMessage'], $request->get('dateofreceivedMessage')) ? true : false;
        });
    }
    // if (!empty($request->get('search'))) {
    // $instance->collection = $instance->collection->filter(function ($row) use ($request) {
    // if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))){
    // return true;
    // }else 
    // if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
    // return true;
    // }
    // return false;
    // });
    // }
    })
    ->addColumn('statu', function ($data) {    
                    if($data->statu==0)
                    return '<span class="label label-success">رفع تجميد</span>';
                    else
                    return  '<span class="label label-danger"> تم تجميده</span>';
                })
                ->addColumn('edit', function ($data) {
                    if(Auth::user()->can('local_block_lists-edit'))
    
                    return '<a class="btn btn-primary btn-xs waves-effect waves-light" href="' . route('local_block_lists/edit',  encrypt($data->id)) . '">تعديل </a>';
                    else 
    
                    return '';
                
                })
                ->rawColumns(['statu','edit'])
                        ->make(true);
    }
       return view('dashboard.local_block_lists.index');
}
    

    // public function index(Request $request)
    // {
    //     // ActivityLogger::activity("قوائم الحظر المحلية");
    //     // $data = LocalBlockLists::latest()->get();
    //     // // $data=$data->where('statement', 'Like', '%شركة فالكون لإستيراد السيارت وقطع الغيار%')->all();
    //     // dd($data);
    //     // if(!empty($request->statement)){

    //     // }
    //     if ($request->ajax()) {
    //         $data = LocalBlockLists::latest()->get();
    //         // $request->statement="ف";
    //         // if(!empty($request->statement)){
    //         //     $data=$data->where('statement', 'like', '%'.$request->statement.'%')->get();
    //         //     dd($request);

    //         // }
        
            
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
                    
    //                  ->addColumn('statu', function ($data) {
                
                
    //             if($data->statu==0)
    //             return '<span class="label label-success">رفع تجميد</span>';
    //             else
    //             return  '<span class="label label-danger"> تم تجميده</span>';
    //         })
    //         ->addColumn('edit', function ($data) {
    //             if(Auth::user()->can('local_block_lists-edit'))

    //             return '<a class="btn btn-primary btn-xs waves-effect waves-light" href="' . route('local_block_lists/edit',  encrypt($data->id)) . '">تعديل </a>';
    //             else 

    //             return '';
            
    //         })
    //         ->rawColumns(['statu','edit'])
    //                 ->make(true);
    //     }
    
    //     return view('dashboard.local_block_lists.index');
    // }


    


   
    
    public function uplode(){

        ActivityLogger::activity("عرض صفحة تحميل قوائم الحظر المحلي");


        return view('dashboard.local_block_lists.uplode');

    }

    public function export(Request $request){

    $fileName="LocalBlockLists".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".xlsx";
    return Excel::download(new LocalBlockListsExport($request), $fileName);
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
            // $existsRecord=LocalBlockLists::where('file_name',"=",$fileName)->count();
            // if($existsRecord != 0){
            //     Alert::warning("لقد سبق وتم تحميل هذا الملف مسبقا (". $fileName.")");
            //     return redirect()->back();
            //  }
           

            DB::transaction(function () use ($request,$fileName) {
                //remove old data
                DB::table('local_block_lists')->delete();  

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
            'statement' => ['required', 'string','unique:local_block_lists'],
            'hiddenBy' => ['required','string'],
            'dateofreceivedMessage' => ['required'],
            'index' => ['required','string'],
        ]);
        try {
            DB::transaction(function () use ($request) {

                $localBlockLists = new LocalBlockLists();
                $localBlockLists->statement=$request->statement;
                $localBlockLists->hiddenBy=$request->hiddenBy;
                $localBlockLists->dateofreceivedMessage=$request->dateofreceivedMessage;
                $localBlockLists->index=$request->index;
                $localBlockLists->notes=$request->notes;
                $localBlockLists->statu=($localBlockLists->notes== null) ? 1 : 0;

                 ActivityLogger::activity($localBlockLists->statement. ":إضافه شركة لقوائم الحظر المحلية ");
                $localBlockLists->save();
            });

            Alert::success('تمت إضافة شركة  '.$request->statement.' لقوائم الحظر المحلية');
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
    public function edit($id)
    {
        $localBlockLists_id = decrypt($id);
        $localBlockLists = LocalBlockLists::find($localBlockLists_id);
        ActivityLogger::activity($localBlockLists->name . ":عرض صفحة تعديل  بيانات  شركة من قوائم الحظر المحلية");
        return view('dashboard.local_block_lists.edit')->with('localBlockLists', $localBlockLists);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $localBlockLists_id = decrypt($id);

        $this->validate($request, [
            'statement' => ['required', 'string','unique:local_block_lists,statement,'.$localBlockLists_id],
            'hiddenBy' => ['required','string'],
            'dateofreceivedMessage' => ['required'],
            'index' => ['required','string'],
        ]);

    
        

        try {
            $localBlockLists = LocalBlockLists::find($localBlockLists_id);

            DB::transaction(function () use ($request, $localBlockLists) {
                $localBlockLists->statement=$request->statement;
                $localBlockLists->hiddenBy=$request->hiddenBy;
                $localBlockLists->dateofreceivedMessage=$request->dateofreceivedMessage;
                $localBlockLists->index=$request->index;
                $localBlockLists->notes=$request->notes;
                $localBlockLists->statu=($localBlockLists->notes== null) ? 1 : 0;
                 ActivityLogger::activity($localBlockLists->id. ":تعديل بيانات  شركة من قوائم الحظر المحلية ");
                $localBlockLists->save();

            });

            Alert::success('تمت عملية تعديل بيانات'.$localBlockLists->statement.' من قوائم الحظر المحلية بنجاح');

            return redirect()->route('local_block_lists');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($localBlockLists_id . ":  فشل تعديل بيانات شركة من قوائم الحظر المحلية ");

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalBlockLists $localBlockLists)
    {
        //
    }
}
