@foreach ($mainCategories as $cat)
	@if ($category->id != $cat->id)
		<ul>
			<li id="{{$cat->id}}" data-jstree='{"opened":true  @if($cat->is_end_category == 1),"disabled": true @endif @if ($category->parent_id == $cat->id),"selected":true @endif }'>
				{{$cat->translateOrDefault(locale())->title}}
				@if($cat->children->count() > 0)
					@include('category::dashboard.tree.categories.edit',['mainCategories' => $cat->children, "category"=> $category])
				@endif
			</li>
		</ul>
	@endif
@endforeach
