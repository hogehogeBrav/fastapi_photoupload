import os
from fastapi import FastAPI, Request
from fastapi.responses import HTMLResponse, ORJSONResponse, RedirectResponse, FileResponse
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates
from starlette.status import HTTP_302_FOUND
import ast
import shutil
import uvicorn

app = FastAPI()

@app.post("/fileupload")
async def fileupload_post(request: Request):

    new_path = "uploads"#フォルダ名
    if not os.path.exists(new_path):#ディレクトリがなかったら
        os.mkdir(new_path)

    # アップロードされたファイルを保存する
    form = await request.form()
    uploadedpath = "./uploads"
    files = os.listdir(uploadedpath)
    for formdata in form:
        uploadfile = form[formdata]
        path = os.path.join("./uploads", uploadfile.filename)
        fout = open(path, 'wb')
        while 1:
            chunk = await uploadfile.read(100000)
            if not chunk: break
            fout.write (chunk)
        fout.close()
    return {"status":"OK" , "filename":uploadfile.filename}

if __name__ == "__main__":
    uvicorn.run(app, port=8081, host='127.0.0.1')