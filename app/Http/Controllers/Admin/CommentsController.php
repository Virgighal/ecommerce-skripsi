<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * go to create product page
     *
     * @return void
     */
    public function create($id)
    {
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $commentId = $id;

        return view('admin.comments.create')
            ->with('commentId', $commentId);
    }

    /**
     * send comment
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, $commentId)
    {
        $user = auth()->user();

        // find comment
        $comment = Comment::where('id', $commentId)->first();
        if(empty($comment)) {
            return redirect()->back()->with('error_message', 'Sorry! this comment is no longer exists');
        }

        // find order
        $order = Order::where('id', $comment->order_id)->first();
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

        return redirect()->route('admin.comments.show', [
            $comment->order_id
        ])->with('success_message', 'Successfully send comment');
        
    }

    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $orderId)
    {   
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $comments = Comment::orderBy('id', 'ASC')->where('order_id', $orderId)->paginate(25);

        return view('admin.comments.show')
            ->with('comments', $comments);
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
