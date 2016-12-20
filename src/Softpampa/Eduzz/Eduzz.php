<?php

namespace Softpampa\Eduzz;

class Eduzz
{
    /**
     * Verifica se o campo 'nsid' é válido.
     *
     * @param string $nsid        - NSID recebido
     * @param string $edz_fat_cod - Código da Fatura que originou a entrega
     * @param string $edz_cnt_cod - Código do conteúdo que o cliente final comprou na Eduzz
     * @param string $edz_cli_cod - Código do Cliente que efetuou o pagamento da fatura na Eduzz
     *
     * @return bool
     */
    private function checkNsid($nsid, $edz_fat_cod, $edz_cnt_cod, $edz_cli_cod)
    {
        return $nsid == sha1($edz_fat_cod + $edz_cnt_cod + $edz_cli_cod);
    }

    /**
     * Verifica se o campo 'sid' é válido.
     *
     * @param string $sid     - SID recebido
     * @param array  $params  - Parâmetros recebidos via POST
     * @param string $api_key - Chave do produto
     *
     * @return bool
     */
    private function checkSid($sid, $params, $api_key)
    {
        $params = sort($params);
        $string = implode('', $params);
        $string .= $api_key;

        return $sid == md5($string);
    }

    /**
     * Processa entrega customizada.
     *
     * @param array $params - Parâmetros recebidos via POST
     * @param string $api_key - Chave do produto
     *
     * @return bool
     */
    public static function custom($params, $api_key)
    {
        $validNsid = $this->checkNsid($params['nsid'], $params['edz_fat_cod'], $params['edz_cnt_cod'], $params['edz_cli_cod']);
        $validSid = $this->checkSid($params['sid'], $params, $api_key);

        if (!($validNsid and $validSid)) {
            return false;
        }

        // falta implementar o BD
    }
}
