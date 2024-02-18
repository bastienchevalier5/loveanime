from requests import get
from bs4 import BeautifulSoup
import time
import random
import math
import sqlite3
import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
import seaborn as sns
sns.set(font_scale=1.5)

url = 'https://myanimelist.net/reviews.php?t=anime&p;=6'
headers = {
        "User-Agent": "mal review scraper for research."
}
response = get(url)
print(response.status_code)

html_soup = BeautifulSoup(response.text, 'html.parser')
print (html_soup)


