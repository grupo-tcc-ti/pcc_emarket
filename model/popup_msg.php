<?php
class Message
{
    // protected static $mensagem = [];
    protected static $mensagem;

    public static function pop($mensagem = 'Hello World!')
    {
        self::$mensagem = array($mensagem);
        if (isset(self::$mensagem)) {
            foreach (self::$mensagem as $mensagem) {
                sleep(.9);
                echo '
                <div class="mensagem">
                <span>'.$mensagem.'</span>
                <i class="fas fa-times" onclick = "closeMessage(this);"></i>
                </div>
                ';
                sleep(1);
            }
        }
    }
    
}
?>
<!-- <i class="fas fa-times" onclick = "this.parentElement.remove();"></i> -->