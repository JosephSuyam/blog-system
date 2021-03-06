@extends('layout.layout')

@section('content')
    <div class="container">
        <a href="{{ (strpos($_SERVER['REQUEST_URI'], '/home/')) ? '/newblogsystem/public/users/home' : 'home' }}"><button class="btn btn-danger" style="float: right;">Go to Home Page</button></a>
        <div class="row">
            <div ng-app="myApp" ng-controller="myCtrl">
                <div class="col-md-8 col-md-offset-2">
                    <div class="col-sm-4">
                    	<div class = "panel panel-default" style="min-width: 65%;">
                                <div class = "panel-heading" style="font-size: 30px;">
                                    <center>My Blogs</center>
                                </div>
                                <div class = "panel-body" style = "width: 100%; font-size: 20px;">
                                    <!--SHOW MYBLOGS-->
                                    @foreach($blogs as $blog)
        	                            @if(isset($blog))
        			                        <li>
        			                            <a href="{{ (strpos($_SERVER['REQUEST_URI'], '/home/')) ? $blog->id : 'home/'.$blog->id }}">
        			                                {{ $blog->blog_title }}
        			                            </a>
        			                        </li>
        			                    @else
        			                        <span>You have no blogs yet</span>
        			                    @endif
        			                @endforeach
                                </div><!--panel-body-->
                            </div><!--panel-->
                    </div>
                    <div class="col-sm-8">
                    @if(isset($blog))
                        <form method="POST" action="{{ (strpos($_SERVER['REQUEST_URI'], '/home/')) ? $blog->id.'/addBlog' : 'home/'.$blog->id.'/addBlog' }}">
                            {{ csrf_field() }}
                            <div class = "panel panel-default" style="min-width: 65%;">
                                <div class = "panel-heading" style="background-color: #FFFFFF   ;">
                                    <input type="text" name="blog_title" placeholder="New Blog Title" value="{{ (isset($blog->blog_title)) ? $blog->blog_title : '' }}" style="width: 100%; font-size: 30px; outline: none; border: 0;" placeholder="New blog title here...">
                                </div>
                                <div class = "panel-body" style = "width: 100%;">
                                    <textarea name="blog" placeholder="Write your new blog here..." style="width: 100%; font-size: 20px; margin-top: 12px; height: 275px; resize: vertical; outline: none; border: 0;" placeholder="Write your new blog here...">{{ (isset($blog->blog)) ? $blog->blog : '' }}</textarea>
                                </div><!--panel-body-->
                            </div><!--panel-->
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <button type="submit" name="delete" class="btn btn-outline-danger">Delete</button>
                            <button type="submit" name="saveButton" class="btn btn-outline-success" style="float: right;">Save</button>
                            <div class="dropup" style = "width: ; float: right; margin-right: 20px;">
                                <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown">Publish Settings&nbsp;<span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><input type = "submit" value = "Publish" name="publish" class = "btn btn-success" style = "display: inline-block; width: 100%;"/></li>
                                    <li><input type = "submit" value = "Unpublish" name="unpublish" id = "" class = "btn btn-success" style = "display: inline-block; width: 100%;"/></li>
                                </ul>
                            </div>
                        </form>
                        @if(!strpos($_SERVER['REQUEST_URI'], '/home/'))
                            <a href="addblog"><button class="btn btn-info" style="float: right; margin-top: 20px;">Add Blog</button></a>
                        @endif
                    @else
                        <form method="POST" action="addblog/new">
                            {{ csrf_field() }}
                            <div class = "panel panel-default" style="min-width: 65%;">
                                <div class = "panel-heading" style="background-color: #FFFFFF;">
                                    <input type="text" name="blog_title" placeholder="New Blog Title" value="" style="width: 100%; font-size: 30px; outline: none; border: 0;" placeholder="New blog title here...">
                                </div>
                                <div class = "panel-body" style = "width: 100%;">
                                    <textarea name="blog" placeholder="Write your new blog here..." style="width: 100%; font-size: 20px; margin-top: 12px; height: 250px; resize: vertical; outline: none; border: 0;" placeholder="Write your new blog here..."></textarea>
                                </div><!--panel-body-->
                            </div><!--panel-->
                            <button type="submit" name="saveButton" class="btn btn-info" style="float: right; margin-right: ;">Save</button>
                        </form>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
            <div class="form-group"><center>
                <div class="alert alert-info" style="width: 40%;"><a href="" class="close" data-dismiss="alert">&times;</a><strong>{{ Session::get('message') }}</strong></div>
            </center></div>
        @endif
    </div>

    <script>
        var app = angular.module('myApp', []);
        app.controller('myCtrl', function($scope) {
            $scope.blog_title = "";   
        });
    </script>

@endsection