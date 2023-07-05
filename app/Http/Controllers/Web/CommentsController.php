<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * send comment
     *
     * @param Request $request
     * @return void
     */
    public function send(Request $request)
    {
        $user = auth()->user();
        $orderId = $request->order_id;

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
        $comment->order_id = $order->id;
        $comment->text = $request->text;
        $comment->save();

        return redirect()->with('success_message', 'Successfully send comment');
        
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
