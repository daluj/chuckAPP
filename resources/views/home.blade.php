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
        <strong>Receive your search on your email (Optional)</strong>
        <form action="/chuck" method="GET">
            <input type="email" name="email" placeholder="Introduce email (Optional)"/><br><br>

            <h3>Usage</h3>
            <p>Retrieve a random chuck joke.</p>
            <button formtarget="_blank" type="submit" name="action" value="random" class="btn btn-success float-right">Random</button>
            <p>Retrieve a random chuck norris joke from a given category.</p>
            <select name="category" class="form-control" style="width:250px">
                <option value="">--- Select Category ---</option>
                @foreach ($categories as $value)
                <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
            <button formtarget="_blank" type="submit" name="action" value="category" class="btn btn-success float-right">Search</button>

            <p>Free text search.</p>
            <input type="text" name="word" placeholder="Search introducing a word"/>
            <button formtarget="_blank" type="submit" name="action" value="words" class="btn btn-success float-right">Search</button><br>
        </form>
    </section>
</div>
</div>
</body>
</html>
