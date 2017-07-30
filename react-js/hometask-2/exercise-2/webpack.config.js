// для работы с полными путями ставим дополнительное расширение "path"
const path = require('path');

module.exports = {
    // что собирать
    entry: path.join(__dirname, 'app', 'main.js'),
    // куда выводить
    output: {
        path: path.join(__dirname, 'dist'),
        filename: 'bundle.js',
        library: 'lib'
    },

    // подключаем devtool, чтобы видеть модули в отладчике
    devtool: 'source-map',

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "babel-loader"
            }
        ]
    },

    // Конфигурируем веб-сервер
    // Запуск - npm run server
    // Остановка Windows CMD - for /f "tokens=5" %a in ('netstat -aon ^| findstr 9000 ^| findstr LISTENING') do taskkill /pid %a /f
    devServer: {
        contentBase: path.join(__dirname, 'dist'),
        port: 9000,
        open: true
    }

};