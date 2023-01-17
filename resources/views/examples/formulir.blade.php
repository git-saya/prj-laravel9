<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blade Template</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>Formulir</h3>
    @includeWhen($user['remember'], 'templates.notification', ['status' => 'complete'])

    <form action="" method="POST">
        <div>🚀
            <select name="langs" id="langs">
                <option value="">translate</option>
                @each('templates.langs', $langs, 'lang', 'templates.error')
            </select>
        </div>

        @includeIf("templates.email")
        <x-forms.input />
        <x-alert type="success" :message="$message" class="mt-4" />
        <x-forms.button type="button" />

        <x-card>
            
            Some quick example text to build on the card title 
            and make up the bulk of the card's content.

            <x-slot:footer class="text-center">
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </x-slot:footer>

            <x-slot:title class="font-xl">
                Card title
            </x-slot:title>
        </x-card>

        <div>
            <input type="checkbox" name="remember" id="remember" @checked($user['remember']) /> Ingat Saya
        </div>

        <div>   
            <button type="submit" @disabled(true)>Submit</button>
        </div>
    </form>
</body>

</html>