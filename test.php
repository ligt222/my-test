<!DOCTYPE html>
<html>
<head>
    <title>title</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .columns {
            width: 100%;
            overflow: hidden;
            display: grid;
            grid-template-columns: 300px auto 300px;
        }

        .content {
            order: 2;
            background: red;
        }

        .sidebar-left {
            order: 1;
            background: blue;
        }

        .sidebar-right {
            order: 3;
            background: green;
        }

    </style>
</head>
<body>
<!--Первый квест----------------------------------------->
<div class="columns">
    <div class="content"></div>
    <div class="sidebar-left"></div>
    <div class="sidebar-right"></div>
</div>
<!--Второй квест----------------------------------------->
<input type="text" id="brackets" value="">
<button id="clock" onClick='return isCorrect("brackets")' type="submit">submit</button>
<div id="result"></div>
<script>
    function isCorrect() {
        var text = document.getElementById('brackets').value;
        if (typeof text !== 'string')
            return false;

        let stack = [],
            hooks = {'(': ')', '{': '}', '[': ']'},
            openHooks = [], // Открытые скобки
            closeHooks = [], // Закрытые скобки
            str = text;
        Object.keys(hooks).forEach(e => openHooks.push(`\\${e}`));
        openHooks = new RegExp(openHooks.join('|'));
        for (let i in hooks) if (hooks.hasOwnProperty(i)) closeHooks.push(`\\${hooks[i]}`);
        closeHooks = new RegExp(closeHooks.join('|'));
        while ((tmp = openHooks.exec(str)) && (str = str.substr(++tmp.index))) stack.push(tmp[0]);
        str = text;
        while ((tmp = closeHooks.exec(str)) && (str = str.substr(++tmp.index)))
            if (!stack.length || hooks[stack.pop()] !== tmp[0]) return false;
        return true;

    }

    $('#clock').click(function () {
        if (isCorrect()) {
            $('#result').text('Корректно')
        } else {
            $('#result').text('Не корректно')
        }
    });

</script>
</body>
</html>