<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Track;
use App\Models\Train;
use App\Models\Type;
use App\Models\Method;
use App\Models\Passenger;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Menampilkan pesanan sesuai hak akses
        $orders = Gate::allows('isAdmin') ? Order::all() : Order::where('user_id', Auth::id())->get();

        // Mengarahkan ke view pesantiket
        return view('pesantiket', [
            'orders' => $orders,
            'complaints' => Complaint::all()
        ]);
    }

    public function create()
    {
        // Menyediakan data untuk form pemesanan tiket
        return view('pesantiket', [
            'tracks' => Track::all(),
            'trains' => Train::all(),
            'tickets' => Ticket::all(),
            'methods' => Method::all()
        ]);
    }

    public function store(Request $request)
    {
        // Validasi Order
        $validatedOrder = $request->validate([
            'ticket_id' => ['required', 'exists:tickets,id'],
            'amount' => ['required', 'integer', 'min:1', 'max:5'],
            'go_date' => ['required', 'date'],
        ]);

        // Menambahkan user_id dan order_code
        $validatedOrder['user_id'] = auth()->id();
        $validatedOrder['order_code'] = (string) number_format(microtime(true) * 1000, 0, '', '');

        // Menyimpan data Order
        $order = Order::create($validatedOrder);

        // Validasi dan Buat Transaction
        $validatedTransaction = $request->validate([
            'method_id' => ['required', 'exists:methods,id'],
            'name_account' => ['required', 'string'],
            'from_account' => ['required', 'string']
        ]);

        $validatedTransaction['order_id'] = $order->id;
        $validatedTransaction['total'] = $order->ticket->price->price * $validatedOrder['amount'];
        $validatedTransaction['status'] = false;

        // Menyimpan data Transaction
        Transaction::create($validatedTransaction);

        // Validasi dan Buat Passengers
        for ($i = 1; $i <= $validatedOrder['amount']; $i++) {
            if (
                $request->filled("nama_penumpang_$i") &&
                $request->filled("nik_penumpang_$i") &&
                $request->filled("jenis_penumpang_$i")
            ) {
                Passenger::create([
                    'order_id' => $order->id,
                    'name' => $request->input("nama_penumpang_$i"),
                    'id_number' => $request->input("nik_penumpang_$i"),
                    'gender' => $request->input("jenis_penumpang_$i") === "true",
                ]);
            } else {
                return back()->withErrors(['Penumpang ke-' . $i . ' belum lengkap!'])->withInput();
            }
        }

        // Redirect ke halaman transaksi setelah berhasil
        return redirect('/transactions')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function show(Order $order)
    {
        // Belum digunakan
    }

    public function edit(Order $order)
    {
        // Belum digunakan
    }

    public function update(Request $request, Order $order)
    {
        // Belum digunakan
    }

    public function destroy(Order $order)
    {
        // Menghapus transaksi yang terkait dengan order
        $transaction = Transaction::where('order_id', $order->id)->first();
        if ($transaction) {
            $transaction->delete();
        }

        // Menghapus order
        $order->delete();

        // Redirect setelah penghapusan
        return redirect('/pesantiket')->with('hapus', 'Data berhasil dihapus!');
    }
}
