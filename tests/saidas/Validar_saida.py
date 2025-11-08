from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome()

# 1. Login
driver.get("http://localhost/raizesLocais/visao/sistema/login.php")
time.sleep(2)
driver.find_element(By.NAME, "usuario").send_keys("Vitor")
driver.find_element(By.NAME, "senha").send_keys("123")
driver.find_element(By.NAME, "senha").send_keys(Keys.RETURN)
time.sleep(2)

# 2. Acessa a tela de validação de saída
driver.get("http://localhost/raizesLocais/visao/sistema/validar_saida.php")
time.sleep(2)

# 3. Clica no botão "Aprovar" da primeira saída pendente
botoes_aprovar = driver.find_elements(By.CLASS_NAME, "aprovar")
if botoes_aprovar:
    botoes_aprovar[0].click()
    time.sleep(2)
    if "aprovada" in driver.page_source.lower() or "saida validada" in driver.page_source.lower():
        print("✅ Saída validada com sucesso!")
    else:
        print("⚠️ Saída aprovada, mas sem confirmação visível.")
else:
    print("❌ Nenhuma saída pendente para validar.")

driver.quit()
