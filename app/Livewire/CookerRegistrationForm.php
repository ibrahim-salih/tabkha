<?php

namespace App\Livewire;

use App\Models\Cooker;
use App\Models\Country;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Livewire\WithFileUploads; // Add this line

class CookerRegistrationForm extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $firstName, $lastName, $phone, $gender, $pirthdate;
    public $country, $state, $address;
    public $email, $password;
    public $img_front, $img_back;
    public $successMessage = '';
    public $catchError;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'firstName' => 'required|string|max:60|unique:cookers,f_name',
            'phone' => 'required|min:11|max:13|regex:/^([0-9\s\-\+\(\)]*)$/|unique:cookers,phone',
        ]);
    }

    public function render()
    {
        // return view('livewire.cooker-registration-form');
        return view('livewire.cooker-registration-form', [
            'countries' => Country::get(),
        ]);
    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'firstName' => 'required|string|max:60|unique:cookers,f_name',
            'lastName' => 'required|string|max:40',
            'gender' => 'required|in:Male,Female',
            'phone' => 'required|max:15|unique:cookers,phone',
            'pirthdate' => 'required|date',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'country' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'address' => 'required|string|max:160',
        ]);

        $this->currentStep = 3;
    }

    public function threeStepSubmit()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:cookers,email',
            'password' => 'min:6|required',
            'password_confirmation' => 'min:6|required_with:password_confirmation|same:password',
        ]);

        $this->currentStep = 4;
    }

    public function fourStepSubmit()
    {
        $validatedData = $this->validate([
            'img_front' => 'required|image|mimes:jpg,jpeg,png|max:5096',
            'img_back' => 'required|image|mimes:jpg,jpeg,png|max:5096',
            'accept' => 'required',
        ]);

        $this->currentStep = 5;
    }
    public function submitForm()
    {
        // Validate the data
        // $validatedData = $this->validate([
        //     'firstName' => 'required|string|max:60|unique:cookers,f_name',
        //     'lastName' => 'required|string|max:40',
        //     'gender' => 'required|in:Male,Female',
        //     'phone' => 'required|string|max:15|unique:cookers,phone',
        //     'country' => 'required|exists:countries,id',
        //     'state' => 'required|exists:states,id',
        //     'address' => 'nullable|string|max:160',
        //     'password' => 'min:6|required',
        //     'password_confirmation' => 'min:6|required_with:password_confirmation|same:password',
        //     'email' => 'required|email|unique:cookers,email',
        //     'img_front' => 'required|image|mimes:jpg,jpeg,png|max:5096',
        //     'img_back' => 'required|image|mimes:jpg,jpeg,png|max:5096',
        //     'accept' => 'required',
        // ]);

        // Hash the password (use a default or generate one if not provided)
        // $validatedData['interests'] = json_encode($validatedData['interests']);

        // Create a new user
        // User::create($validatedData);
        try {
            $cooker = Cooker::create([
                'f_name' => $this->firstName,
                'l_name' => $this->lastName,
                'gender' => $this->gender,
                'phone' => $this->phone,
                'country_id' => $this->country,
                'state_id' => $this->state,
                'ID_img_front' => $this->img_front,
                'ID_img_back' => $this->img_back,
                'address' => $this->address,
                'password' => bcrypt($this->password),
                'email' => $this->email,
                // 'status' => $this->status,
            ]);

            // Set success message
            $this->successMessage = 'تم التسجيل بنجاح';

            // Clear the form
            $this->clearForm();

            // Reset the step
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }


    public function nextStep()
    {
        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->firstName = '';
        $this->lastName = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->country = '';
        $this->gender = '';
    }
}
