<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index(Request $request)
    {
        if(!empty(auth()->user()) && auth()->user()->user_level != 'User') {
            return redirect()->route('admin.home');
        }

        $orderId = $request->order_id;

        $order = Order::where('id', $orderId)->first();
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'order is no longer exists!');
        }

        // find comment
        $comments = Comment::where('order_id', $order->id)->get();
    

        return view('web.comment', [
            'active_menu' => 'comment',
            'order_id' => $orderId,
            'comments' => $comments
        ]);
    }

    /**
     * send comment
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, $orderId)
    {
        $user = auth()->user();

        // find order
        $order = Order::where('id', $orderId)->first();
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Sorry! this order is no longer exists');
        }

        if(empty($request->text)){
            return redirect()->back()->with('error_message', 'Please enter a comment!');
        }

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->username = $user->name;
        $comment->order_id = $order->id;
        $comment->text = $request->text;
        $comment->save();

        return redirect()->route('profile')->with('success_message', 'Successfully send comment');
        
    }

    /**
     * Delete Comment
     *
     * @param Request $request
     * 
     */
    public function delete(Request $request)
    {
        $user = auth()->user();
        $orderId = $request->order_id;
        $commentId = $request->comment_id;

        // find order
        $order = Order::where('id', $orderId)->first();
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Sorry! this order is no longer exists');
        }

        // find comment
        $comment = Comment::where('id', $commentId)->first();
        if(empty($order)) {
            return redirect()->back()->with('error_message', 'Sorry! this comment is no longer exists');
        }

        if(empty($request->text)){
            return redirect()->back()->with('error_message', 'Please enter a comment!');
        }

        $comment->delete();

        return redirect()->with('success_message', 'Successfully deleted comment');

    }
}
