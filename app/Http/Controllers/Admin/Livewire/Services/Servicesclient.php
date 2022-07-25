<?php

namespace App\Http\Controllers\Admin\Livewire\Services;

use App\Models\User;
use App\Models\Service;
use App\Models\UserService;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class Servicesclient extends Component
{

    public $client_name;
    public $all_client_name;
    public $service_id;

    public function render()
    {
        $services = Service::active()->with('currency')->get();

        return view('admin.livewire.services.servicesclient', compact('services'));
    }

    public function updateQuery()
    {
        $this->all_client_name = User::where('name', 'like', '%' . $this->client_name . '%')
            ->get(['id', 'name'])->toArray();
    }
    public function get_service()
    {
    }

    public function validate_client_service()
    {


        try {
            //code...


            $rules = [
                'client_name' => 'required|exists:Users,name',
                'service_id' => 'required|exists:services,id',
            ];

            $messages = [
                '*.required' => __('site.its_require'),
                'client_name.exists' => __('site.its_exists_in_user'),
                'service_id.exists' => __('site.its_exists_in_services_list'),
                // 'email.email' => 'The :attribute format is not valid.',
            ];

            $this->validatedData_client_services =  $this->validate($rules, $messages);
            if ($this->validatedData_client_services) {
                $user_id = User::GetIdByName($this->client_name);
                $services = Service::find($this->service_id);
                // dd($services);
                $register_services_to_client = UserService::create([
                    'service_id' => $this->service_id,
                    'user_id' => $user_id,
                    'amount' => $services['fee'],
                    'paid_amount' => 0,
                    'remaining' => $services['fee']
                ]);


                if (!$register_services_to_client) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'erroe',  'message' => __('site.wrong try again')]);
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('site.Post created successfully!')]);
// dd(route('admin.payment.user_paid_for_services', $register_services_to_client->id));
                    return redirect()->route('admin.payment.user_paid_for_services', $register_services_to_client->id);
                }
            }
        } catch (\Throwable $th) {
            throw $th;
            $this->dispatchBrowserEvent('alert', ['type' => 'erroe',  'message' => __('site.wrong try again')]);
        }
    }
    public function mount()
    {
        $this->client_name = '';
        $this->all_client_name = [];
        $this->service_id = 0;
    }
}
