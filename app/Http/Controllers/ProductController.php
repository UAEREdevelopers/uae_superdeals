<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendNewOrderReceivedEmails;


class ProductController extends Controller
{
    public function index(Request $request){
        $sortBy = 'id';
        $sortOrder = 'asc';
        $filter_sort = request('filter_sort') ?? '';
        $filterArr = [
            'price_desc' => ['price', 'desc'],
            'price_asc' => ['price', 'asc'],
            'sort_desc' => ['sort', 'desc'],
            'sort_asc' => ['sort', 'asc'],
            'id_desc' => ['id', 'desc'],
            'id_asc' => ['id', 'asc'],
        ];
        if (array_key_exists($filter_sort, $filterArr)) {
            $sortBy = $filterArr[$filter_sort][0];
            $sortOrder = $filterArr[$filter_sort][1];
        }

        $products = Product::where('category_id', 14)
               ->orderBy('id')
               ->paginate(12);
        

        /* load from vuejs */
        //return view('products.frontend.show');
        /* load from php blade */
        return view('frontend.products.list', compact('products'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showProduct($id)
    {
       
        $product = Product::findOrFail($id);
        

        return view('frontend.products.show',compact('product'));
    } 

    public function addToCart(Request $request){    

        $cart = session('cart') ?? [];

        $item = [
            'product' => $request->product,
            'price' => $request->price,
            'qty' => $request->qty ?? '',
            'size' => $request->size ?? ''
        ];

        if($cart !=null ){
           
            foreach($cart as $key => $value ){
               
                if($cart[$key]['product'] == $item['product'] ){
                        
                    $cart[$key]['qty'] = (int)$cart[$key]['qty'] + (int)$item['qty'] ;
                }  
                       
            }
        }

        else{
                array_push($cart, $item);
            }


        Session::put('cart', $cart);
        Session::flash('session', 'Item added to cart');
        
        return view('frontend.general_cart');
    }

    public function buy(Request $request){

        $country = explode('|', $request->country)[1];
              
        $invoice = Invoice::create([
            'unique_id' =>  generate_long_unique_id(),
            'user_id' =>auth()->user()->id ?? '',
            'name' =>$request->firstname.' '.$request->lastname ?? '',
            'phone' => $request->phone ??'',
            'email' => $request->email ??'',
            'address' => $request->address ?? '',
            'street' => $request->street ?? '',
            'city' => $request->city ?? '',
            'country' => $country ?? '',
            'price' => get_total_price()
        ]);

       $payment =  save_to_payments_table($invoice , 'product');

       $invoice->update(['payment_table_id' => $payment['id']]);

       $cart = session('cart');
       foreach($cart as $item){

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'name' => $item['product'].'-'.$item['size'],
            'qty' => $item['qty'],
            'price'=> $item['price']
        ]);
       }

       $invoice->load('items');  
        
    return redirect()->route('payment_link', ['id'=> $payment['unique_id']]);


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        Product::create($request->all());
     
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('frontend.products.show',compact('product'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('frontend.products.edit',compact('product'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
