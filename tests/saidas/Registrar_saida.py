from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
import time

driver = webdriver.Chrome()

# Login
driver.get("http://localhost/raizesLocais/visao/sistema/login.php")
time.sleep(2)
driver.find_element(By.NAME, "usuario").send_keys("Vitor")
driver.find_element(By.NAME, "senha").send_keys("123")
driver.find_element(By.NAME, "senha").send_keys(Keys.RETURN)
time.sleep(2)

# Registro de saída
driver.get("http://localhost/raizesLocais/visao/sistema/saidas.php")
time.sleep(2)

driver.find_element(By.NAME, "data").send_keys("06/11/2025")
Select(driver.find_element(By.NAME, "produto")).select_by_visible_text("Milho")
driver.find_element(By.NAME, "quantidade").send_keys("3")
driver.find_element(By.XPATH, "//button[text()='Salvar']").click()
time.sleep(2)

# Verificação e mensagem
if "✅ Saída registrada com sucesso!" in driver.page_source:
    print("✅ Saída registrada com sucesso!")
else:
    print("❌ Falha ao registrar a saída.")

driver.quit()
