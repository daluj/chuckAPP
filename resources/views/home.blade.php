<!DOCTYPE html>
<html lang="en">
<head>

    <title>Chuck</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://api.chucknorris.io/css/styles.css" rel="stylesheet" type="text/css"/>

    </head>
<body>
<div class="wrapper">
    <header>
        <h1>
            Chuck Norris Facts
        </h1>
    </header>
    <div id="content">
    <section>
        <strong>{{ __('lang.email')}}</strong>
        <form action="{{ route('chuck', app()->getLocale()) }}" method="GET">
            <input type="email" name="email" placeholder="{{ __('lang.email_placeholder')}}"/><br><br>

            <h3>{{ __('lang.usage')}}</h3>
            <p>{{ __('lang.random_title')}}</p>
            <button formtarget="_blank" type="submit" name="action" value="random" class="btn btn-success float-right">{{ __('lang.random')}}</button>
            <p>{{ __('lang.category')}}</p>
            <select name="category" class="form-control" style="width:250px">
                <option value="">{{ __('lang.select_category')}}</option>
                @foreach ($categories as $value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <button formtarget="_blank" type="submit" name="action" value="category" class="btn btn-success float-right">{{ __('lang.search')}}</button>

            <p>{{ __('lang.text_search')}}</p>
            <input type="text" name="word" placeholder="{{ __('lang.search_placeholder')}}"/>
            <button formtarget="_blank" type="submit" name="action" value="words" class="btn btn-success float-right">{{ __('lang.search')}}</button><br>
        </form>
    </section>
</div>
</div>
</body>
</html>
