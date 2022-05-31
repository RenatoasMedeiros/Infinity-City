import sys
import time
import requests
import winsound

def play_sound (nome):
    winsound.PlaySound(nome+".wav", winsound.SND_FILENAME)

try :
    r = requests.get('http://127.0.0.1/ti/api/api.php?nome=temperatura')
    temp = float(r.text)
    print( "Prima CTRL+C para terminar")
    while True: # ciclo para o programa executar sem parar…
        print("*** LER temperatura do servidor ***")  
        if (r.status_code == 200):
            print("Temperatura: ", r.text)
            if (temp > 20):
                print("Temperatura HIGH: ", r.text)
                play_sound("Alarm")       
            else:
                print("Temperatura LOW: ", r.text)
        else:
            print("O pedido HTTP não foi bem sucedido")     
        time.sleep (2)
except KeyboardInterrupt: # caso haja interrupção de teclado CTRL+C
    print( "Programa terminado pelo utilizador")
except : # caso haja um erro qualquer
    print( "Ocorreu um erro:", sys.exc_info() )
finally : # executa sempre, independentemente se ocorreu exception
    print( "Fim do programa")