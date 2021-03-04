FROM python:3.9.2-alpine3.12

RUN apk update \
    && apk add --virtual build-deps gcc python3-dev musl-dev build-base \
    && apk add --no-cache mariadb-dev

COPY requirements.txt /tmp
#RUN pip install mysqlclient
RUN python -m pip install --upgrade pip && \
  pip install -r /tmp/requirements.txt

# clean up files and deps
RUN apk del build-deps
RUN rm /tmp/requirements.txt

EXPOSE 5000:5000

CMD python /api/lib/api.py
