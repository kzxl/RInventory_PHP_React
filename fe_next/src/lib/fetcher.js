export async function fetchData({
  url,
  method = 'GET',
  headers = {},
  body = null,
  baseUrl = process.env.NEXT_PUBLIC_API_BASE || '', // dễ cấu hình
}) {
  try {   
    const res = await fetch(`${baseUrl}/${url}`, {
      method,
      headers: {
        'Content-Type': 'application/json',
        ...headers,
      },
      body: body ? JSON.stringify(body) : null,
      cache: 'no-store', // tránh cache ở SSR nếu dùng App Router
    });

    const contentType = res.headers.get('content-type');
    const isJson = contentType && contentType.includes('application/json');
    const data = isJson ? await res.json() : await res.text();

    if (!res.ok) {
      throw new Error(data?.message || 'Fetch error');
    }

    return data;
  } catch (err) {
    console.error(`[fetchData] ${method} ${url}`, err);
    throw err;
  }
}
