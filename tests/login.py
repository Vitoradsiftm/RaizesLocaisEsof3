from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
import time

driver = webdriver.Chrome()

driver.get("http://localhost/raizesLocais/visao/sistema/login.php")
time.sleep(2)

driver.find_element(By.NAME, "usuario").send_keys("Vitor")
driver.find_element(By.NAME, "senha").send_keys("123")
driver.find_element(By.NAME, "senha").send_keys(Keys.RETURN)
time.sleep(2)

# Verifica se login foi bem-sucedido
if "Dashboard" in driver.page_source or "sistema" in driver.current_url.lower():
    print("✅ Login realizado com sucesso!")
else:
    print("❌ Falha no login.")

driver.quit()
