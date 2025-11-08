from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome()

# Login
driver.get("http://localhost/raizesLocais/visao/sistema/login.php")
time.sleep(2)
driver.find_element(By.NAME, "usuario").send_keys("Vitor")
driver.find_element(By.NAME, "senha").send_keys("123")
driver.find_element(By.NAME, "senha").send_keys(Keys.RETURN)
time.sleep(2)

# Cadastro de produto
driver.get("http://localhost/raizesLocais/visao/sistema/produtos.php")
time.sleep(2)

driver.find_element(By.NAME, "nome").send_keys("Milho")
driver.find_element(By.NAME, "saldo").send_keys("10")
driver.find_element(By.NAME, "salvar").click()
time.sleep(2)

# Verificação e mensagem
if "Milho" in driver.page_source:
    print("✅ Produto 'Milho' cadastrado com sucesso!")
else:
    print("❌ Falha ao cadastrar o produto.")

driver.quit()
