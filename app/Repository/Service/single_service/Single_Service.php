<?php
namespace  App\Repository\Service\single_service;
use App\Interfaces\Service\single_service\Single_ServiceInterface;
use App\Models\Service\SingleService;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class Single_Service implements Single_ServiceInterface
{
   public function index()
   {
     $services=SingleService::all();
     return view('Dashboard.Services.SingleService.index',compact('services'));
   }
    // TODO: Implement store() method.
   public function store($request)
   {


          try{
            $validation=Validator::make($request->all(),[
                'name'=>['required','string','min:6'],
                'price'=>['required','integer','min:2'],
                'description'=>['required','string','min:35'],

              ]);
              if($validation->fails()){
                  return redirect()->back()->withErrors('error',$validation->errors());
              }
              $service=new SingleService();
              $service->name=$request->name;
              $service->description=$request->description;
              $service->status=1;
              $service->price=$request->price;
              $service->save();
              session()->flash('add');
              return redirect()->back();

          }catch (Exception $e){
              return redirect()->back()->withErrors('error',$e->getMessage());
          }
      }
    // TODO: Implement update() method.
      public function update( $request)
      {
          try{

              $service=SingleService::findOrFail($request->id);
              $service->name=$request->name;
              $service->description=$request->description;
              $service->status=$request->status;
              $service->price=$request->price;
              $service->save();
              session()->flash('edit');
              return redirect()->route('services.index');

          }catch (Exception $e){
              return redirect()->back()->withErrors('error',$e->getMessage());
          }
      }

    // TODO: Implement destroy() method.
      public function destroy($request)
      {
         $service=SingleService::findOrFail($request->id);
         $service->delete();
         session()->flash('delete');
         return back();
      }
}

