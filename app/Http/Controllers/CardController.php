<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\TestList;
use App\Services\CardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * @var CardService
     */
    private $cardService;

    public function __construct(CardService $cardService) {
        $this->cardService = $cardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TestList $list)
    {
        return view('card.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $store = $this->cardService->create($request);

        if ($store['status'])
            return redirect()->back()->with('success', $store['message']);

        return redirect()->back()->with('error', $store['message'])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        $list = $card->test_list_card->test_list;

        return view('card.edit', compact('card', 'list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   
        $update = $this->cardService->update($request);

        if ($update['status'])
            return redirect()->back()->with('success', $update['message']);

        return redirect()->back()->with('error', $update['message'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $delete = $this->cardService->delete($card);

        if ($delete['status'])
            return redirect()->back()->with('success', $delete['message']);

        return redirect()->back()->with('error', $delete['message'])->withInput();
    }
}
