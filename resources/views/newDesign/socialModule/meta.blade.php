@include('newDesign.socialModule._index',[
    'title'         => (isset($title))          ? $title        : 'Robota molodi',
    'description'   => (isset($description))    ? $description  : 'Go to work',
    'url'           => (isset($url))            ? $url          : env('APP_URL'),
    'image'         => (isset($image))          ? $image        : 'http://images6.fanpop.com/image/photos/36800000/Mr-T-mrt-36834265-320-254.png'
])