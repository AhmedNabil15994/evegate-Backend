@foreach ($mainCategories as $category)
<ul>
	<li id="{{$category->id}}" data-jstree='{"opened":true
		{{ ($category->is_end_category == 0 ) ? ',"disabled":true' : ''  }}
		 }'>
		{{$category->translate(locale())->title}}
		@if($category->children->count() > 0)
			@include('user::dashboard.tree.companies.create',
                                    ['mainCategories' => $category->children ]
             )
		@endif
	</li>
</ul>
@endforeach
