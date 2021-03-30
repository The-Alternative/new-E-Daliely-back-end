<?php
namespace App\Service\Categories;

use App\Models\Categories\Section;
use App\Models\Categories\SectionTranslation;
use App\Models\Custom_Fildes\Custom_Field;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use App\Exceptions\GeneralHandler;
use Exception;
use LaravelLocalization;

class SectionService
{
    use GeneralTrait;
    private $SectionService;
    private $SectionModel;




    public function __construct(Section $sectionModel)
    {
        $this->SectionModel=$sectionModel;
    }

    /****Get All Active category Or By ID  ****/

    public function get()
    {
        $section = Section::withTrans()->get();
        return $response= $this->returnData('Section',$section,'done');
    }
    public function getById($id )
    {
        $section = Section::withTrans()->find($id);
        return $response= $this->returnData('Section',$section,'done');
    }
        /****ــــــThis Functions For Trashed Sections  ****/
    /****Get All Trashed Sections Or By ID  ****/

    public function getTrashed()
    {
        $section = Section::withTrans()->where('is_active',0)->get();
          return $this -> returnData('Section',$section,'done');
    }
    /****Restore category Fore Active status  ****/

    public function restoreTrashed( $id)
    {
        $section=Section::find($id);
        $section->is_active=true;
        $section->save();
            return $this->returnData('Section', $section,'This Section Is trashed Now');
    }
        /****   category's Soft Delete   ****/

    public function trash( $id)
    {
        $section=Section::find($id);
        $section->is_active=false;
           $section->save();
            return $this->returnData('Section', $section,'This Section Is trashed Now');
    }

    /*ــــــــــــــــــــــــ  ـــــــــــــــــــــــ*/

    /****  Create Section   ***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    /*___________________________________________________________________________*/
        public function create(Request $request)
        {
            try
            {
//                $validated = $request->validated();
                $request->is_active?$is_active=true:$is_active=false;
//                $request->is_appear?$is_appear=true:$is_appear=false;
                //transformation to collection
                $allsections = collect($request->section)->all();


                ///select folder to save the image
                // $fileBath = "" ;
                //     if($request->has('image'))
                //     {
                //         $fileBath=uploadImage('images/products',$request->image);
                //     }
                DB::beginTransaction();
                // //create the default language's product
                $unTransSection_id=Section::insertGetId([

                    'slug' => $request['slug'],
                    'image' => $request['image'],
                    'is_active' => $request['is_active'],
                    'categories_id' => $request['categories_id']
                ]);
                //check the category and request
                if(isset($allsections) && count($allsections))
                {
                    //insert other traslations for sections
                    foreach ($allsections as $allsection)
                    {
                        $transSection_arr[]=[
                            'name' => $allsection['name'],
                            'description' =>$allsection['description'],
                            'local' => $allsection['local'],
                            'section_id' => $unTransSection_id
                        ];
                    }
                    SectionTranslation::insert($transSection_arr);
                }
                DB::commit();
                return $this->returnData('category', [$unTransSection_id,$transSection_arr],'done');
            }
            catch(\Exception $ex)
            {
                DB::rollback();
                return $this->returnError('category','faild');
            }
        }

    /*___________________________________________________________________________*/

    /****  Update category   ****/

    public function update(Request $request,$id)
    {
//        $validated = $request->validated();
        try{
            $section= Section::find($id);
            if(!$section)
                return $this->returnError('400', 'not found this Category');
           $allsections= collect($request->section)->all();
            if (!($request->has('category.is_active')))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);
            //save image
            // if($request->has('image')) {
            //     $filePath = uploadImage('products', $request->photo);
            //     Product::where('id', $pro_id)
            //         ->update([
            //             'image' => $filePath,
            //         ]);
            // }

           $ncategory=Section::where('id',$id)->update([
               'slug' => $request['slug'],
               'image' => $request['image'],
               'is_active' => $request['is_active'],
               'categories_id' => $request['categories_id']
            ]);
            $ss=SectionTranslation::where('section_id',$id);
            $collection1 = collect($allsections);
            $allsectionslength=$collection1->count();
            $collection2 = collect($ss);

              $db_section= array_values(SectionTranslation::where('section_id',$id)->get()->all());
              $dbdsections = array_values($db_section);
              $request_sections = array_values($request->section);
                foreach($dbdsections as $dbdsection){
                    foreach($request_sections as $request_section){
                        $values= SectionTranslation::where('section_id',$id)->where('local',$request_section['local'])->update([
                            'name' => $request_section['name'],
                            'description' =>$request_section['description'],
                            'local' => $request_section['local'],
                            'section_id' => $id
                        ]);
                    }
                }
            return $this->returnData('Category', $dbdsections,'done');
            DB::commit();
        }
        catch(\Exception $ex){
            return $ex;
            return $this->returnError('400', 'saving failed');
        }
    }
    /*___________________________________________________________________________*/
    /****  ٍsearch for Product   ***
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     */

    public function search($name)
    {
        $section = DB::table('sections')
                ->where("name","like","%".$name."%")
                ->get();
        if (!$section)
        {
            return $this->returnError('400', 'not found this Section');

        }
          else
            {
                return $this->returnData('Category', $section,'done');
            }
    }
    /*___________________________________________________________________________*/

    /****  Delete Product   ****/

    public function delete($id)
    {
        $section=$this->Section::find($id);
        if ($section->is_active=0)
            {
                $section=Section::destroy($id);
                 return $this->returnData('Section', $section,'This Section Is deleted Now');
            }
    }


}
