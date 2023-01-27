<?php
class responses
{
    // HTTP Code 200 (OK)
    public function status_200($data): array
    {
        $this->response['code'] = 200;
        $this->response['status'] = 'OK';
        $this->response['data'] = $data;
        /*$this->response['result'] = array(
            'data' => $message
        );*/
        return $this->response;
    }

    // HTTP Code 401 (Unauthorized)
    public function status_401($message): array
    {
        $this->response['code'] = 401;
        $this->response['status'] = 'Unauthorized';
        $this->response['data'] = array(
            'error' => $message
        );
        return $this->response;
    }

    // HTTP Code 406 (Not Acceptable)
    public function status_406($message): array
    {
        $this->response['code'] = 406;
        $this->response['status'] = 'Not Acceptable';
        $this->response['data'] = array(
            'error' => $message
        );
        return $this->response;
    }
}