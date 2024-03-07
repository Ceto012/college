<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class AsteriskHelper
{
    private static $port = 5038;
    private static $username = "munisjlami";
    private static $password = "muni2024sjl";
    private static $ip = "192.168.20.132";

    private static function connectSocket()
    {
        $socket = stream_socket_client("tcp://" . self::$ip . ":" . self::$port, $errno, $errstr, 30);

        if (!$socket) {
            return response()->json(['error' => 'No se pudo conectar al socket.'], 500);
        }

        $authenticationRequest = "Action: Login\r\n";
        $authenticationRequest .= "Username: " . self::$username . "\r\n";
        $authenticationRequest .= "Secret: " . self::$password . "\r\n";
        $authenticationRequest .= "Events: off\r\n\r\n";

        if (!fwrite($socket, $authenticationRequest)) {
            fclose($socket);
            return response()->json(['error' => 'Error al escribir la solicitud de autenticación en el socket.'], 500);
        }

        usleep(200000);
        $authenticateResponse = fread($socket, 4096);

        if (strpos($authenticateResponse, 'Success') === false) {
            fclose($socket);
            return response()->json(['error' => 'No se pudo autenticar en la Interfaz del Administrador de Asterisk.'], 500);
        }

        return $socket;
    }
    
    public static function sip($extension, $contexto)
    {
        $socket = static::connectSocket();

        if (!$socket) {
            return response()->json(['error' => 'No se pudo conectar al socket.'], 500);
        }

        $extensionRequest = "Action: UpdateConfig\r\n";

        $extensionRequest .= "Srcfilename: sip.conf\r\n";
        $extensionRequest .= "Dstfilename: sip.conf\r\n";

        $extensionRequest .= "Action-000000: NewCat\r\n";
        $extensionRequest .= "Cat-000000: $extension\r\n";

        $extensionRequest .= "Action-000001: Append\r\n";
        $extensionRequest .= "Cat-000001: $extension\r\n";
        $extensionRequest .= "Var-000001: type\r\n";
        $extensionRequest .= "Value-000001: friend\r\n";

        $extensionRequest .= "Action-000002: Append\r\n";
        $extensionRequest .= "Cat-000002: $extension\r\n";
        $extensionRequest .= "Var-000002: defaultuser\r\n";
        $extensionRequest .= "Value-000002: $extension\r\n";

        $extensionRequest .= "Action-000003: Append\r\n";
        $extensionRequest .= "Cat-000003: $extension\r\n";
        $extensionRequest .= "Var-000003: secret\r\n";
        $extensionRequest .= "Value-000003: Muni" . $extension . "SJL\r\n";

        $extensionRequest .= "Action-000004: Append\r\n";
        $extensionRequest .= "Cat-000004: $extension\r\n";
        $extensionRequest .= "Var-000004: context\r\n";
        $extensionRequest .= "Value-000004: $contexto\r\n";

        $extensionRequest .= "Action-000005: Append\r\n";
        $extensionRequest .= "Cat-000005: $extension\r\n";
        $extensionRequest .= "Var-000005: host\r\n";
        $extensionRequest .= "Value-000005: dynamic\r\n";

        $extensionRequest .= "Action-000006: Append\r\n";
        $extensionRequest .= "Cat-000006: $extension\r\n";
        $extensionRequest .= "Var-000006: qualify\r\n";
        $extensionRequest .= "Value-000006: yes\r\n";

        $extensionRequest .= "Action-000007: Append\r\n";
        $extensionRequest .= "Cat-000007: $extension\r\n";
        $extensionRequest .= "Var-000007: disallow\r\n";
        $extensionRequest .= "Value-000007: all\r\n";

        $extensionRequest .= "Action-000008: Append\r\n";
        $extensionRequest .= "Cat-000008: $extension\r\n";
        $extensionRequest .= "Var-000008: allow\r\n";
        $extensionRequest .= "Value-000008: alaw\r\n";

        $extensionRequest .= "Action-000009: Append\r\n";
        $extensionRequest .= "Cat-000009: $extension\r\n";
        $extensionRequest .= "Var-000009: nat\r\n";
        $extensionRequest .= "Value-000009: force_rport,comedia\r\n\r\n";

        $extensionRequest .= "Action: Command\r\n";
        $extensionRequest .= "ActionID: 1\r\n";
        $extensionRequest .= "Command: sip reload\r\n\r\n";

        $extensionRequest .= "Action: UpdateConfig\r\n";

        $extensionRequest .= "Srcfilename: extensions.conf\r\n";
        $extensionRequest .= "Dstfilename: extensions.conf\r\n";

        $extensionRequest .= "Action-000000: NewCat\r\n";
        $extensionRequest .= "Cat-000000: $contexto\r\n\r\n";

        if (!fwrite($socket, $extensionRequest)) {
            fclose($socket);
            return response()->json(['error' => 'Error al escribir la solicitud de actualización de configuración en el socket.'], 500);
        }

        usleep(200000);
        $extensionResponse = fread($socket, 4096);

        if (strpos($extensionResponse, 'Success') === false) {
            fclose($socket);
            return response()->json(['error' => 'No se pudo agregar la extensión.'], 500);
        }

        fclose($socket);
        return response()->json(['message' => 'Extensión agregado correctamente'], 200);
    }

    public static function extension($extension, $contexto)
    {
        $socket = static::connectSocket();

        if (!$socket) {
            return response()->json(['error' => 'No se pudo conectar al socket.'], 500);
        }

        $extensionRequest = "Action: UpdateConfig\r\n";

        $extensionRequest .= "Srcfilename: extensions.conf\r\n";
        $extensionRequest .= "Dstfilename: extensions.conf\r\n";

        $extensionRequest .= "Action-000000: Append\r\n";
        $extensionRequest .= "Cat-000000: $contexto\r\n";
        $extensionRequest .= "Var-000000: exten\r\n";
        $extensionRequest .= "Value-000000: >$extension,1,Dial(SIP/$extension)\r\n\r\n";

        $extensionRequest .= "Action: Command\r\n";
        $extensionRequest .= "ActionID: 2\r\n";
        $extensionRequest .= "Command: dialplan reload\r\n\r\n";

        if (!fwrite($socket, $extensionRequest)) {
            fclose($socket);
            return response()->json(['error' => 'Error al escribir la solicitud de actualización de configuración en el socket.'], 500);
        }

        usleep(200000);
        $extensionResponse = fread($socket, 4096);

        if (strpos($extensionResponse, 'Success') === false) {
            fclose($socket);
            return response()->json(['error' => 'No se pudo agregar el dialplan.'], 500);
        }

        fclose($socket);
        return response()->json(['message' => 'Dialplan agregado correctamente'], 200);
    }

    public static function llamar($mensaje, $numero)
    {
        $socket = static::connectSocket();

        if (!$socket) {
            return response()->json(['error' => 'No se pudo conectar al socket.'], 500);
        }

        $internalPhoneline = "Local/s@call-queue";
        $context = "alerta";
        $target = "s";

        $originateRequest = "Action: Originate\r\n";
        $originateRequest .= "Channel: $internalPhoneline\r\n";
        $originateRequest .= "Callerid: Click 2 Call\r\n";
        $originateRequest .= "Exten: $target\r\n";
        $originateRequest .= "Context: $context\r\n";
        $originateRequest .= "Priority: 1\r\n";
        $originateRequest .= "Variable: MensajeAlerta=$mensaje\r\n";
        $originateRequest .= "Variable: Numero=$numero\r\n";
        $originateRequest .= "Timeout: 120000\r\n";
        $originateRequest .= "Async: yes\r\n\r\n";

        if (!fwrite($socket, $originateRequest)) {
            fclose($socket);
            return response()->json(['error' => 'Error al escribir la solicitud de origen en el socket.'], 500);
        }

        usleep(200000);
        $originateResponse = fread($socket, 4096);

        if (strpos($originateResponse, 'Success') === false) {
            fclose($socket);
            return response()->json(['error' => 'No se pudo realizar la llamada.'], 500);
        }

        fclose($socket);
        return response()->json(['message' => 'La llamada se realizó correctamente'], 200);
    }

}
