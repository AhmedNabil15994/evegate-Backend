

@foreach ($mainCategories as $category)
<ul>
	<li id="{{$category->id}}" data-jstree='{"opened":true
		{{ ($categories->contains($category->id)) ? ',"selected":true' : ''  }} }'>
		{{$category->translate(locale())->title}}
		@if($category->children->count() > 0)
			@include('user::dashboard.tree.users.edit',
                                    ['mainCategories' => $category->children , "categories"=> $categories]
             )
		@endif
	</li>
</ul>
@endforeach
