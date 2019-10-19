<html>
  <head>
    <title>download</title>
    <meta charset="UTF-8">
  </head>
    <body>
            <h1>sao ge nb</h1>
            <form method="POST" action="{{url('hape')}}">
            {{ csrf_field() }}
            <button type="submit">点我</button>
            </form>
            <a href="{{url('hape')}}">点我</a>
    </body>
</html>