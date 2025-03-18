<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'product_name' => 'required|string',
            'unit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'total_amount' => 'required|numeric',
        ]);

        $item = InvoiceItem::create($request->all());
        return response()->json($item, 201);
    }

    public function destroy(InvoiceItem $invoiceItem)
    {
        $invoiceItem->delete();
        return response()->json(null, 204);
    }
}

