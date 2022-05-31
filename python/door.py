import sys
import requests
from time import strftime, gmtime
from msvcrt import kbhit, getch

def datahora():
    return strftime("%d/%m/%Y %H:%M:%S", gmtime())

def send_to_api(array_dados = {'nome': 'nome_atuador' , 'valor': 'valor_atuador', 'hora': datahora}):

    r = requests.post("http://127.0.0.1/ti/api/api.php", data=array_dados)

    if (r.status_code == 200):
        print("OK: POST realizado com sucesso") 
        print(r.status_code)
    else:
        print("ERRO: Não foi possível realizar o pedido")
        print(r.status_code)

try:
    print("Usage:\n[0]Fecha a porta\n[1]Abre a porta\n[CTRL+C]Terminar")

    while True:

        if kbhit():
            estado_porta = getch().decode("ASCII")
            print(estado_porta)
            if (estado_porta == '0'):
                array_dados = {'nome': 'porta', 'valor': 0, 'hora': datahora()}
                send_to_api(array_dados)
                print("\nPorta foi fechada")
            elif (estado_porta == '1'):
                array_dados = {'nome': 'porta', 'valor': 1, 'hora': datahora()}
                send_to_api(array_dados)
                print("\nPorta foi aberta")
            else:
                print("\nOpção inválida")
     
    datahora = datahora()
    print(datahora)

except:
    print( "Ocorreu um erro:", sys.exc_info() )