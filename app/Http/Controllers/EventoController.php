<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;

class EventoController extends Controller
{
    //

    public function index()
    {

        $search = request('search');

        if ($search) {
            $events = Event::where([
                ['titulo', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Event::all();
        }
        return view('index', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = new Event;

        $event->titulo = $request->titulo;
        $event->cidade = $request->cidade;
        $event->descricao = $request->descricao;
        $event->privado = $request->privado;
        $event->itens = $request->itens;
        $event->data = $request->data;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;

            $extension = $requestImagem->extension();
            $imageName = md5($requestImagem->getClientOriginalName() . strtotime('now')) . '.' . $extension;

            $requestImagem->move(public_path('img/events'), $imageName);

            $event->imagem = $imageName;
        } else {
            $event->imagem = "latrel.gif";
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasJoined = false;

        // echo($id);
        // dd($event);

        if ($user) {
            $eventsParticipant = $user->eventsAsParticipant;
            foreach ($eventsParticipant as $eventuser) {
                if ($eventuser->id == $id) {
                    $hasJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasJoined' => $hasJoined]);
    }

    public function dashboard()
    {

        $search = request('search');

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        // echo($user);
        // if ($search) {
        //     $events = Event::where([
        //         ['titulo', 'like', '%' . $search . '%'],
        //         ['user_id', $user->id],
        //     ])->get();
        // } else {
        $events = Event::where([
            ['user_id', $user->id],
        ])->get();
        // }
        // return view('dashboard', ['events' => $events, 'search' => $search]);
        return view('dashboard', ['events' => $events, 'search' => $search, 'eventsasparticipant' => $eventsAsParticipant]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluido com sucesso!');
    }

    public function edit($id)
    {
        $user = auth()->user();

        $event = Event::findOrFail($id);
        if ($user->id != $event->user->id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;

            $extension = $requestImagem->extension();
            $imageName = md5($requestImagem->getClientOriginalName() . strtotime('now')) . '.' . $extension;

            $requestImagem->move(public_path('img/events'), $imageName);

            $data['imagem'] = $imageName;
        }
        Event::findOrFail($request->id)->update($data);

        return redirect('dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinevent($id)
    {

        $user = auth()->user();

        $eventsParticipant = $user->eventsAsParticipant;

        // dd($eventsParticipant);
        if ($eventsParticipant) {
            foreach ($eventsParticipant as $event) {
                if ($event->id == $id) {
                    return redirect('events/' . $id)->with('msg', "Presença já confirmada no evento ");
                }
            }
        }


        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('dashboard')->with('msg', "Presença confirmada no evento " . $event->titulo);
    }
    public function leaveevent($id)
    {

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('dashboard')->with('msg', "Presença removida no evento " . $event->titulo);
    }
}
