<?php
namespace App\api\contacts\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\api\contacts\application\Contacts;
use Illuminate\Http\Request;
use App\Models\Contact;



class ContactsController extends BaseController implements CrudController
{

    protected $contacts;

    public function __construct(Contacts $contacts)
    {
       $this->contacts=$contacts;
    }



    public function get(Request $request)
    {
        try {
            $contact = $this->contacts->getId($request->id);

            if ($contact) {
                return $this->sendResponse($contact, 'Contact info');
            }
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Contact not found', 404);
        }

        return $this->sendError('Contact not found', 404);

    }

    /**
     * contacts.index
     *
     *
     */
    public function index(Request $request)
    {

        $contacts = $this->contacts->paginate();

        if ($contacts) {
            return $this->sendResponse($contacts, 'Contacts list');
        }

        return $this->sendError('Contacts not found', 404);

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string', 'not_in:string', 'max:255'],
            'last_name' => ['nullable', 'string', 'not_in:string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'not_in:string'],
            'email' => ['required', 'string', 'email', 'not_in:user@example.com', 'max:255'],
            'phone' => ['nullable', 'string', 'not_in:string'],
            'phone2' => ['nullable', 'string', 'not_in:string'],
            'photo' => ['nullable', 'string', 'not_in:string'],
            'address' => ['nullable', 'string', 'not_in:string'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            ]);


        $contact = $this->contacts->store($data);

        if ($contact) {
            return $this->sendResponse($contact, 'Contact created');
        }


        return $this->sendError('Contact not found', 404);

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['nullable', 'string', 'not_in:string', 'max:255'],
            'last_name' => ['nullable', 'string', 'not_in:string', 'max:255'],
            'birth_date' => ['nullable', 'date', 'date_format:Y-m-d', 'not_in:string'],
            'email' => ['nullable', 'string', 'email', 'not_in:user@example.com', 'max:255'],
            'phone' => ['nullable', 'string', 'not_in:string'],
            'phone2' => ['nullable', 'string', 'not_in:string'],
            'photo' => ['nullable', 'string', 'not_in:string'],
            'address' => ['nullable', 'string', 'not_in:string'],
            'user_id' => ['sometimes', 'required', 'integer', 'exists:users,id'],
        ]);

        try {

            $contact = $this->contacts->update($data);

            if ($contact) {
                return $this->sendResponse($contact, 'Contact updated');
            }
        } catch (ModelNotFoundException $e) {
            return $this->sendError('Contact not found', 404);
        }


    }

    public function remove(Request $request)
    {

        $data = $request->validate([
            'id' => ['required']
        ]);

        try {

            $contact = $this->contacts->remove($request->id);

            if ($contact) {
                return $this->sendResponse($contact, 'Contact deleted');
            }

        }catch (ModelNotFoundException $e){
            return $this->sendError('Contact not found', 404);
        }

    }

}
