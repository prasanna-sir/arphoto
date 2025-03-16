<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
public function checkout()
{
    $cartItems = Auth::user()->cartItems()->with('product')->get();
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty!');
    }

    $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
    $order = Order::create([
        'user_id' => Auth::id(),
        'total' => $total,
        'payment_method' => 'cash_on_delivery',
    ]);

    // Clear cart after checkout
    foreach ($cartItems as $item) {
        $item->delete();
    }

    return redirect()->route('order.confirmation', $order->id)->with('success', 'Order placed with Cash on Delivery!');
}
public function confirmation(Order $order)
{
    return view('cart.confirmation', compact('order'));
}

    public function increase(CartItem $cartItem)
{
    if ($cartItem->user_id === Auth::id()) {
        $cartItem->quantity += 1;
        $cartItem->save();
        return redirect()->route('cart.index')->with('success', 'Quantity increased!');
    }
    return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
}

public function decrease(CartItem $cartItem)
{
    if ($cartItem->user_id === Auth::id()) {
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return redirect()->route('cart.index')->with('success', 'Quantity decreased!');
        }
        return redirect()->route('cart.index')->with('error', 'Quantity cannot be less than 1.');
    }
    return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
}
    public function __construct()
    {
        $this->middleware('auth'); // Restrict all methods to logged-in users
    }

    public function add(Request $request, Product $product)
    {
        $user = Auth::user();

        // Check if the product is already in the cart
        $cartItem = CartItem::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Increment quantity if item exists
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Add new item to cart
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('home')->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function remove(CartItem $cartItem)
    {
        // Ensure the cart item belongs to the user
        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
    }
}
