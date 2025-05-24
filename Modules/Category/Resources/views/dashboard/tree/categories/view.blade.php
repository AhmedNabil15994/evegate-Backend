
@foreach ($mainCategories as $category)
  <ul>
    <li id="{{ $category->id }}" data-jstree='{"opened":true, "disabled": {{ $category->is_end_category == 1 }} }'>
      {{ optional($category->translate(locale()))->title }}
      @if ($category->children->count() > 0)
        @include('category::dashboard.tree.categories.view', ['mainCategories' => $category->children])
      @endif
    </li>
  </ul>
@endforeach
