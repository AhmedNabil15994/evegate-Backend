@foreach ($mainCategories as $category)
<ul>
		<li id="{{$category->id}}" data-jstree='{"opened":true , "disabled": {{$category->is_end_category == 0}} }'>
				{{$category->translate(locale())->title}}
				@if($category->children->count() > 0)
						@include('qsale::dashboard.tree.ads.view',['mainCategories' => $category->children])
				@endif
		</li>
</ul>
@endforeach
