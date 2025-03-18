<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return response()->json(Invoice::with('items')->paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:invoices',
            'date' => 'required|date',
            'customer_name' => 'required|string',
        ]);

        $invoice = Invoice::create($request->all());
        return response()->json($invoice, 201);
    }

    public function show(Invoice $invoice)
    {
        return response()->json($invoice->load('items'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'number' => 'required|unique:invoices,number,' . $invoice->id,
            'date' => 'required|date',
            'customer_name' => 'required|string',
        ]);

        $invoice->update($request->all());
        return response()->json($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return response()->json(null, 204);
    }
}

