<?php
namespace App\api\agencies\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\agencies\application\Agencies;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;



class AgenciesController extends BaseController implements CrudController
{

    protected $agencies;

    public function __construct(Agencies $agencies)
    {
       $this->agencies=$agencies;
    }



    public function get(Request $request)
    {

        try {
            $agency = $this->agencies->getId($request->id);

            if ($agency) {
                return $this->sendResponse($agency, 'Agencies get');
            }
         }catch (ModelNotFoundException $e){
            return $this->sendError('Agency not found', 404);
        }

    }

    /**
     * agencies.index
     *
     *
     */
    public function index(Request $request)
    {

        $agencies = $this->agencies->paginate();

        if ($agencies) {
            return $this->sendResponse($agencies, 'Agencies list');
        }

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            ]);


        $agency = $this->agencies->store($data);

        if ($agency) {
            return $this->sendResponse($agency, 'Agencies create');
        }

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id'=>['required'],
            'name'=>['nullable','string'],
        ]);

        try {

            $agency = $this->agencies->update($data);

            if ($agency) {
                return $this->sendResponse($agency, 'Agencies update');
            }

        }catch (ModelNotFoundException $e){
            return $this->sendError('Agency not found', 404);
        }


    }

    public function remove(Request $request)
    {
        try {

            $data = $request->validate([
                'id' => ['required']
            ]);

            $agency = $this->agencies->remove($request->id);

            if ($agency) {
                return $this->sendResponse($agency, 'Agencies deleted');
            }

        }catch (ModelNotFoundException $e){
            return $this->sendError('Agency not found', 404);
        }

    }


}
