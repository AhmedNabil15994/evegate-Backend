@foreach ($mainCategories as $category)
<ul>
	<li id="{{$category->translate(locale(), true)->slug}}" data-jstree='{"opened":false  
		
		{{ ($category->is_end_category == 0 ) ? ',"disabled":true' : ''  }}
		{{ ( in_array($category->translate(locale(), true)->slug , $selected) ) ? ',"selected":true' : ''  }} }'>
		{{$category->translate(locale(), true)->title}}
		@if($category->children->count() > 0)
			@include('qsale::frontend.tree.view',
                                    ['mainCategories' => $category->children , "selected"=> $selected]
             )
		@endif
	</li>
</ul>
@endforeach
