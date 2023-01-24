import re


def readfile(filepath):
    path = re.sub(r'[^\\]+$', '', __file__) + filepath
    with open(path, 'r', encoding='UTF-8') as f:
        data = f.read()
    return data