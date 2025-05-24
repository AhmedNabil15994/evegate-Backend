@foreach ($mainCategories as $category)
<ul>
	<li id="{{$category->id}}" data-jstree='{"opened":true   
		{{ ($category->is_end_category == 0 ) ? ',"disabled":true' : ''  }}
		{{ ($model->category_id ==  $category->id ) ? ',"selected":true' : ''  }} }'>
		{{$category->translate(locale())->title}}
		@if($category->children->count() > 0)
			@include('offer::tree.offers.edit',
                                    ['mainCategories' => $category->children , "model"=> $model]
             )
		@endif
	</li>
</ul>
@endforeach
