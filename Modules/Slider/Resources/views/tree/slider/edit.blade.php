@foreach ($mainCategories as $category)
<ul>
	<li id="{{$category->id}}" data-jstree='{"opened":true   
		{{ ($model->categories->contains("id", $category->id  ) ) ? ',"selected":true' : ''  }} }'>
		{{$category->translateOrDefault(locale())->title}}
		@if($category->children->count() > 0)
			@include('slider::tree.slider.edit',
                                    ['mainCategories' => $category->children , "model"=> $model]
             )
		@endif
	</li>
</ul>
@endforeach
