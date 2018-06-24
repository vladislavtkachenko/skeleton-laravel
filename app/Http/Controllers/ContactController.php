<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageMail;
use App\Models\Config;
use App\Models\Contact;
use Log;
use Mail;

class ContactController extends Controller
{
    /**
     * Страница "Контакты"
     *
     * @return string
     */
    public function index()
    {
        return 'show contact page';
    }

    /**
     * Сохранение контакта и отправка почты админу
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(ContactRequest $request)
    {
        $data = $request->except('_token');
        \Log::info('New contact: ' . json_encode($data));

        try{
            Contact::create($data);
            $admin = cache()->rememberForever('configs', function () { return Config::all(); })->where('key', 'admin')->first()->value;
            if(mb_strlen($admin) > 1)
                Mail::to($admin)->send(new ContactMessageMail($data));
            return response()->json(['status' => true, 'message' => 'Ваше обращение успешно сохранено']);
        } catch ( \Exception $e) { Log::error($e->getMessage()); }

        return response()->json(['status' => false, 'message' => 'Произошла ошибка']);
    }
}
