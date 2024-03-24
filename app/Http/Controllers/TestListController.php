<?php

namespace App\Http\Controllers;

use App\Models\TestList;
use App\Services\TestListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestListController extends Controller
{
    /**
     * @var TestListService
     */
    private $testListService;

    public function __construct(TestListService $testListService) {
        $this->testListService = $testListService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user               = Auth::user();
        $user_test_lists    = $user->user_test_lists;
        $lists              = [];

        foreach ($user_test_lists as $key => $user_test_list) {
            if ($user_test_list->test_list)
                array_push($lists, $user_test_list->test_list);
        }

        return view('test_list.index', compact('user', 'lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('test_list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user   = Auth::user();
        $store  = $this->testListService->create($request, $user);

        if ($store['status'])
            return redirect()->route('listas.index')->with('success', $store['message']);

        return redirect()->route('listas.index')->with('error', $store['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list   = $this->testListService->findById($id);
        $cards  = [];

        foreach ($list->test_list_cards as $key => $value) {
            if ($value->card)
                array_push($cards, $value->card);
        }

        return view('test_list.show', compact('list', 'cards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $list_id)
    {
        $list = $this->testListService->findById($list_id);
        return view('test_list.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestList $lista)
    {
        $store  = $this->testListService->update($request, $lista);

        if ($store['status'])
            return redirect()->route('listas.index')->with('success', $store['message']);

        return redirect()->route('listas.index')->with('error', $store['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestList $lista)
    {
        $delete  = $this->testListService->delete($lista);

        if ($delete['status'])
            return redirect()->route('listas.index')->with('success', $delete['message']);

        return redirect()->route('listas.index')->with('error', $delete['message']);
    }
}
