<?php

namespace app\commands;

use Yii;
use app\models\Product;
use yii\console\Controller;
use yii\helpers\Console;

// php yii update/run prices.csv
class UpdateController extends Controller
{

    public function actionRun($fileName)
    {
        // Временно разместил всю логику в контроллере, чтобы успеть сдать д\з
        $path = "./data/" . $fileName;
        if (($fp = fopen($path, "r")) !== FALSE) {
            $count = count(file($path));
            $i = 0;
            Console::startProgress(0, $count);
            while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {
                $user = Product::findOne($data[0]);
                $user->price = $data[1];
                $user->save();
                sleep(1);
                Console::updateProgress(++$i, $count);
            }
            fclose($fp);
            Console::endProgress();
            $this->stdout("Price list updated successfully!", Console::FG_GREEN);
            return 0;
        }
        return 1;
    }

}