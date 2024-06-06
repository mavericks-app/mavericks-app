<?php
namespace App\api\contacts\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
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

        $contact = $this->contacts->getId($request->id);

        if ($contact) {
            return $this->sendResponse($contact, 'Contacts get');
        }

    }

    /**
     * Contacts
     *
     *
     */
    public function index(Request $request)
    {

        $contacts = $this->contacts->paginate();

        if ($contacts) {
            return $this->sendResponse($contacts, 'Contacts list');
        }

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            ]);


        $contact = $this->contacts->store($data);

        if ($contact) {
            return $this->sendResponse($contact, 'Contacts create');
        }

    }

    public function update(Request $request)
    {

        $id = $request->route('id');

        $data = $request->validate([
            'name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'date'],
            'email' => ['nullable', 'string', 'email'],
            'phone' => ['nullable', 'string'],
            'phone2' => ['nullable', 'string'],
            'photo' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'user_id' => ['nullable', 'integer', 'exists:users,id']
        ]);

        $this->contacts = Contact::findOrFail($id);

        $contact = $this->contacts->update($data);

        if ($contact) {
            return $this->sendResponse($contact, 'Contacts update');
        }

    }

    public function remove(Request $request)
    {
        try {

            $data = $request->validate([
                'id' => ['required']
            ]);

            $contact = $this->contacts->remove($request->id);

            if ($contact) {
                return $this->sendResponse($contact, 'Contacts deleted');
            }

        }catch (\Exception $e){
            throw  new \Exception("Not found model contact");
        }

    }


}
